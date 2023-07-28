<?php
// controllers/UserController.php

require_once 'models/User.php';

class UserController
{
    private $userModel;

    public function __construct(PDO $db)
    {
        $this->userModel = new User($db);
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        include 'views/partials/header.php';
        include 'views/users/index.php';
        include 'views/partials/footer.php';
    }

    public function create()
    {
        include 'views/partials/header.php';
        include 'views/users/create.php';
        include 'views/partials/footer.php';
    }

    public function store($data, $files)
    {
        $name = trim(  $data['name']);
        $age =  trim($data['age']);
        $image = $files['img'];

        if (empty($name) || empty($age)) {
            // Display an error message or redirect back to the create form
        } else {
            
            $imageName = $this->uploadImage($image);

            $result = $this->userModel->createUser($name,$age, $imageName);
            if ($result) {
                // Redirect to the index page after successful creation
                header('Location: index.php');
                exit;
            } else {
                // Display an error message if the creation fails
               
            }

           
        }
    }


    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);
        include 'views/partials/header.php';
        include 'views/users/edit.php';
        include 'views/partials/footer.php';
    }

    public function update($data, $files)
    {

        $id = $data['id'];
        $name = $data['name'];
        $age = $data['age'];
        $image = $files['img'];


        if (empty($id) || empty($name) || empty($age)) {

        }else{

            // Update the image only if a new one is provided
        $user = $this->userModel->getUserById($id);
        $existingImage  = $user['img'];
        if (!empty($image['tmp_name'] )) {
            // Save the new image to a directory on your server (e.g., 'uploads')
            $imageName = $this->uploadImage($image);
          
            
        }else{
            $imageName = $existingImage;
        }

        
          // Update user in the database using the User model
          $result = $this->userModel->updateUser($id, $name, $age, $imageName);
          if ($result) {
              // Delete the previous image if it was updated
              if (!empty($image['tmp_name'])) {
                  $this->deleteImage($existingImage);
              }

              // Redirect to the index page after successful update
              header('Location: index.php');
              exit;
        } else {
            // Display an error message if the update fails
        }
            
        }
    }

    public function delete($id)
    {
          // Get the user's image filename before deleting
    $user = $this->userModel->getUserById($id);
    $imageName = $user['img'];

    // Delete the user from the database using the User model
    $result = $this->userModel->deleteUser($id);

    if ($result) {
        // Delete the user's image file from the server if it exists
        $this->deleteImage($imageName);

        // Redirect to the index page after successful deletion
        header('Location: index.php');
        exit;
    } else {
        // Display an error message if the deletion fails
    }
    }

    private function uploadImage($image)
    {
        // Provide the path to the 'uploads' directory where the image files are stored
        $uploadDir = 'uploads/';
        $imageName = 'user_' . uniqid() . '_' . $image['name'];

        // Move the uploaded image to the 'uploads' directory
        move_uploaded_file($image['tmp_name'], $uploadDir . $imageName);

        return $imageName;
    }
    
    private function deleteImage($imageName)
    {
        // Provide the path to the 'uploads' directory where the image files are stored
        $imagePath = 'uploads/' . $imageName;

        // Check if the file exists and then delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }


    private function validateInputs($name, $age)
{
    $errors = [];

    // Validate name: Required, alphanumeric characters, and maximum length of 100
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    } elseif (!ctype_alnum($name)) {
        $errors['name'] = 'Name can only contain letters and numbers.';
    } elseif (strlen($name) > 100) {
        $errors['name'] = 'Name cannot exceed 100 characters.';
    }
    if (empty($age)) {
        $errors['name'] = 'Name is required.';
    }
  

    return $errors;
}

}