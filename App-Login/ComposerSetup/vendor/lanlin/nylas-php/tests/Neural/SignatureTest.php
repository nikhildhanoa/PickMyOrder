<?php

namespace Tests\Neural;

use Tests\AbsCase;

/**
 * ----------------------------------------------------------------------------------
 * Message Sending Test
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2021/09/28
 *
 * @internal
 */
class SignatureTest extends AbsCase
{
    // ------------------------------------------------------------------------------

    public function testSignatureExtraction(): void
    {
        $id = $this->faker->uuid;

        $params = [
            'ignore_links'              => true,
            'ignore_images'             => true,
            'ignore_tables'             => true,
            'remove_conclusion_phrases' => true,
            'images_as_markdown'        => true,
            'parse_contacts'            => true,
        ];

        $this->mockResponse($this->getExtractionData());

        $data = $this->client->Neural->Signature->signatureExtraction($id, $params);

        $this->assertArrayHasKey('account_id', $data[0]);
    }

    // ------------------------------------------------------------------------------

    public function testSignatureExtractionFeedback(): void
    {
        $id = $this->faker->uuid;

        $this->mockResponse([
            'model_version' => 'av45hcbkka',
            'message_id'    => '{message_id}',
            'feedback_at'   => '1607537180',
        ]);

        $data = $this->client->Neural->Signature->signatureExtractionFeedback($id);

        $this->assertArrayHasKey($id, $data);
    }

    // ------------------------------------------------------------------------------

    private function getExtractionData(): array
    {
        return [
            [
                'account_id' => '{account_id}',
                'bcc'        => [
                    [
                        'email' => 'Albert Einstein',
                        'name'  => 'al@particletech.com',
                    ],
                ],
                'body' => "<html>\n<head>\n <meta charset=\"UTF-8\">\n <style type=\"text/css\">\n html {\n -webkit-text-size-adjust:none;\n }\n body {\n width:100%;\n margin:0 auto;\n padding:0;\n}\n  p {\n width:280px;\n line-height: 16px;\n letter-spacing: 0.5px;\n }\n </style>\n <title>Welcome  ...  </html>",
                'cc'   => [
                    [
                        'email' => 'George Washington Carver',
                        'name'  => 'carver@agritech.com',
                    ],
                ],
                'date'   => 1557950729,
                'events' => [
                    [
                    ],
                ],
                'files' => [
                    [
                        'account_id'   => '43jf3n4es3***',
                        'content_type' => 'image/jpeg',
                        'filename'     => 'image.jpg',
                        'id'           => '9etjh6talp***',
                        'object'       => 'file',
                        'size'         => 72379,
                    ],
                ],
                'folder' => [
                    'display_name' => 'string',
                    'id'           => 'string',
                    'name'         => 'string',
                ],
                'from' => [
                    [
                        'name'  => 'Marie Curie',
                        'email' => 'marie@radioactivity.com',
                    ],
                ],
                'id'       => 'string',
                'object'   => 'message',
                'reply_to' => [
                    [
                        'email' => 'skwolek@fibers.com',
                        'name'  => 'Stephanie Kwolek',
                    ],
                ],
                'snippet'   => 'string',
                'starred'   => true,
                'subject'   => 'string',
                'thread_id' => 'string',
                'to'        => [
                    [
                        'email' => 'dorothy@spacetech.com',
                        'name'  => 'Dorothy Vaughan',
                    ],
                ],
                'unread' => true,
                'labels' => [
                    [
                        'display_name' => 'Important',
                        'id'           => '{label_id}',
                        'name'         => 'important',
                    ],
                ],
                'model_version' => 'd6d33291',
                'signature'     => "\\--  \n\n[![](https://lh6.googleusercontent.com/zJp7cuIKWhNYHc6KsuHUsfrhyCp9DKxg243bjSLP9JKi9SEX-\nuMtTAr5qy54Kdlr3RNkTwAEvIDHKBCjodqu8uVLLbReY47_-KtRilUatWsZRRfO2LH9ZTCykLEVBOj8iJ7XmNeX)](https://www.nylas.com/)\n\n|\n\nNylas Product Team\n\nNylas Team, [Nylas](https://www.nylas.com/)\n\n[swag@nylas.com](mailto:swag@nylas.com) ",
            ],
        ];
    }

    // ------------------------------------------------------------------------------
}
