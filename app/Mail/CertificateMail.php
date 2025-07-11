<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Employee;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $subjectText;
    public $content;
    public $hrName;

    public function __construct(Employee $employee, $subjectText, $content, $hrName)
    {
        $this->employee = $employee;
        $this->subjectText = $subjectText;
        $this->content = $content;
        $this->hrName = $hrName;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
                    ->view('emails.certificate')
                    ->with([
                        'employee' => $this->employee,
                        'subject' => $this->subjectText,
                        'content' => $this->content,
                        'hrName' => $this->hrName,
                    ]);
    }
}
