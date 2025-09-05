<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use Illuminate\Support\Str;

trait VoAccessor
{
    protected ?object $_parent = null;
    public function initialize(array $arguments): self
    {
        foreach ($arguments as $member_name => $value) {
            if (!property_exists($this, $member_name)) {
                continue;
            }
            $this->{$member_name} = $value;
        }
        return $this;
    }

    /**
     * @param string $name
     * @param string[] $arguments
     * @return void|null
     */
    public function __call(string $name, array $arguments = [])
    {
        $props = explode('_', Str::snake($name));
        if ('get' === $props[0]) {
            array_shift($props);
            $property_name = '_' . implode('_', $props);
            if (isset($this->{$property_name})) {
                return $this->{$property_name};
            }
            return null;
        }
    }
}
