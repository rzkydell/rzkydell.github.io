<?php
class PHP_Email_Form {
    public $to;          // Email tujuan
    public $from_name;   // Nama pengirim
    public $from_email;  // Email pengirim
    public $subject;     // Subjek email
    public $ajax = false; // Apakah menggunakan AJAX
    private $messages = []; // Daftar pesan untuk dimasukkan ke email

    // Tambahkan pesan ke email
    public function add_message($content, $title, $priority = 0) {
        $this->messages[] = [
            'title' => $title,
            'content' => $content,
            'priority' => $priority,
        ];
    }

    // Kirim email
    public function send() {
        // Validasi input dasar
        if (empty($this->to) || empty($this->from_email) || empty($this->from_name) || empty($this->subject)) {
            return false; // Gagal jika salah satu parameter utama kosong
        }

        // Susun isi email
        $email_message = "You have received a new message:\n\n";
        foreach ($this->messages as $message) {
            $email_message .= $message['title'] . ": " . $message['content'] . "\n";
        }

        // Header email
        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";

        // Kirim email menggunakan fungsi mail()
        return mail($this->to, $this->subject, $email_message, $headers);
    }
}
?>
