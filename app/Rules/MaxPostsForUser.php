<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class MaxPostsForUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $userId = Auth::id();
        $postsCount = Post::where('creator_id', $userId)->count();

        if ($postsCount >= 3) {
            $fail("You have reached the limit of 3 posts.");
        }
    }
}
