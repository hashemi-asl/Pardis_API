<?php

namespace App\Controllers;

use App\Core\App;

class BooksController
{

    /**
     * Show all books.
     */
    public function index()
    {
        $books = App::get('database')->selectAll(
            'book',
            'book.id, name, description, image, user_id, username',
            'user'
        );

        echo(json_encode($books));
    }

    /**
     * Show requested book.
     */
    public function show()
    {
        $book = App::get('database')->find(
            'book',
            $_GET['id'],
            'book.id, name, description, image, user_id, username, national_code',
            'user'
        );

        echo(json_encode($book));
    }

    /**
     * Store a new book in the database.
     */
    public function store()
    {
        $imageName = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileNameParts = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameParts));

            // sanitize file-name
            $imageName = md5(time() . $fileName) . '.' . $fileExtension;

            // directory in which the uploaded file will be moved
            $dest_path = './storage/' . $imageName;
            move_uploaded_file($fileTmpPath, $dest_path);
        }

        App::get('database')->insert('book', [
            'user_id' => $_POST['user_id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'image' => $imageName,
        ]);

        header('HTTP/1.1 201 Book Created Successfully');
    }

    /**
     * Download requested image.
     */
    public function downloadImage()
    {
        $filepath = './storage/' . $_GET['file_name'];
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            throw new \Exception('File Not Found!', 404);
        }
    }
}
