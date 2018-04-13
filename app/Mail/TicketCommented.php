<?php
/**
 * NOTICE OF LICENSE
 *
 * UNIT3D is open-sourced software licensed under the GNU General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 * @author     HDVinnie
 */

namespace App\Mail;

use App\Comment;
use App\Ticket;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCommented extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $comment;
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Comment $comment, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ticket_comments')
                    ->with([
                        'ticket'  => $this->ticket,
                        'user'    => $this->user,
                        'comment' => $this->comment,
                    ]);
    }
}