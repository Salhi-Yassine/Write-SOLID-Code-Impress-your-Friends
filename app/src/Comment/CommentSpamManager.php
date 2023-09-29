<?php

namespace App\Comment;

use App\Entity\Comment;
use App\Service\RegexSpamWordHelper;

class CommentSpamManager
{
    private CommentSpamCounterInterface $regexSpamWordHelper;

    public function __construct(CommentSpamCounterInterface $regexSpamWordHelper)
    {
        $this->regexSpamWordHelper = $regexSpamWordHelper;
    }

    public function validate(Comment $comment): void
    {
        $content = $comment->getContent();
        $badWordsOnComment = $this->regexSpamWordHelper->countSpamWords($content);

        if ($badWordsOnComment >= 2) {
            // We could throw a custom exception if needed
            throw new \InvalidArgumentException('Message detected as spam');
        }
    }


}
