<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;

class CommentController extends Controller
{
    protected $rules = [
        'body' => 'required',
    ];

    public function store(Request $request, $type, $content_id)
    {
        $this->validate($request, $this->rules);

        $fields = [
            'content_id' => $content_id,
            'status' => 1,
        ];

        $comment = Auth::user()->comments()->create(array_merge($request->all(), $fields));

        if ($followersEmails = $comment
                ->content
                ->followersEmails()
                ->forget(Auth::user()->id)
                ->toArray()
        ) {
            foreach ($followersEmails as $followerId => $followerEmail) {
                Mail::queue('email.follow.content', ['comment' => $comment], function ($mail) use ($followerEmail, $followerId, $comment) {
                    $mail->to($followerEmail)
                        ->subject(trans('follow.content.email.subject', [
                            'title' => $comment->content->title,
                        ]));

                    $swiftMessage = $mail->getSwiftMessage();
                    $headers = $swiftMessage->getHeaders();

                    $header = [
                        'category' => [
                            'follow_content',
                        ],
                        'unique_args' => [
                            'user_id' => (string) $followerId,
                            'content_id' => (string) $comment->content->id,
                            'content_type' => (string) $comment->content->type,
                        ],
                    ];

                    $headers->addTextHeader('X-SMTPAPI', format_smtp_header($header));
                });
            }
        }

        return redirect()->route('content.show', [$type, $content_id, '#comment-'.$comment->id]);
    }

    public function edit($id)
    {
        $comment = \App\Comment::findorFail($id);

        return \View::make('pages.comment.edit')
            ->with('comment', $comment)
            ->render();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

        $comment = \App\Comment::findorFail($id);

        $fields = [
            'status' => 1,
        ];

        $comment->update(array_merge($request->all(), $fields));

        return redirect()
            ->route('content.show', [
                $comment->content->type,
                $comment->content,
                '#comment-'.$comment->id,
            ]);
    }

    public function status($id, $status)
    {
        $comment = \App\Comment::findorFail($id);

        if ($status == 0 || $status == 1) {
            $comment->status = $status;
            $comment->save();

            return redirect()
                ->route('content.show', [
                    $comment->content->type,
                    $comment->content,
                    '#comment-'.$comment->id,
                ])
                ->with('info', trans("comment.action.status.$status.info", [
                    'title' => $comment->title,
                ]));
        }

        return back();
    }
}
