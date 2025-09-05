<?php

declare(strict_types=1);

namespace App\Libraries;

class BannedWords
{
    protected const string BANNED_WORD_REPLACEMENT = '####';
    protected string $_pattern_banned_words;

    public function __construct()
    {
        // TODO テーブル、もしくはファイル、または定数
        $words = ['バカ', 'アホ'];
        $this->_pattern_banned_words = '/' .
            collect($words)
                ->map(
                    fn($banned_word) => preg_quote(
                        mb_strtolower(mb_convert_kana($banned_word, 'a')),
                        '/'
                    )
                )
                ->implode('|') . '/u';
    }

    /**
     * @param string $word
     * @return void
     */
    public function refReplaceBannedWord(string &$word): void
    {
        $word = mb_strtolower(mb_convert_kana($word, 'a'));
        $word = str_replace('　', ' ', $word);
        $word = preg_replace('/\s+/', ' ', $word);
        $word = preg_replace($this->_pattern_banned_words, self::BANNED_WORD_REPLACEMENT, $word);
    }
}
