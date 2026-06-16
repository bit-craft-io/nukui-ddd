#!/bin/bash
set -e
set -a
source .env
set +a

INPUT_DIR=${INPUT_DIR:-import}
INPUT_FILE_PATH="$INPUT_DIR/$(basename "$INPUT_FILE")"

OUTPUT_FILE=${OUTPUT_FILE:-${INPUT_FILE%.json}.html}
OUTPUT_DIR=${OUTPUT_DIR:-output}
OUTPUT_FILE_PATH="$OUTPUT_DIR/$(basename "$OUTPUT_FILE")"

LAYOUT_FILE_PATH=layout.hbs

mkdir -p "$OUTPUT_DIR"
TMP_JSON=$(mktemp)

node --input-type=module <<EOF > "$TMP_JSON"
import fs from "fs";

const api = JSON.parse(fs.readFileSync("$INPUT_FILE_PATH", "utf-8"));

api.info = { ...api.info, title: "$DOC_TITLE" };
api.servers = [{ url: "$API_URL", description: "$API_URL_DESC" }];

for (const pathItem of Object.values(api.paths || {})) {
  for (const method of ["get","post","put","delete","patch"]) {
    const op = pathItem[method];
    if (op?.operationId && !op.summary?.startsWith(op.operationId + "：")) {
      op.summary = \`\${op.operationId}：\${op.summary || ""}\`;
    }
  }
}

api.tags?.sort((a, b) => a.name.localeCompare(b.name, undefined, { numeric: true, sensitivity: "base" }));

fs.writeFileSync("$TMP_JSON", JSON.stringify(api, null, 2));
EOF

npx @redocly/cli build-docs "$TMP_JSON" \
  -t "$LAYOUT_FILE_PATH" \
  -o "$OUTPUT_FILE_PATH"

rm "$TMP_JSON"
