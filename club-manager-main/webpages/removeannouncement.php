<?php
//resume session here to fetch session values
session_start();
/*
    if the user is not logged in, then redirect to the login page,
    this is to prevent users from accessing pages that require
    authentication such as the dashboard
*/
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'librarian') {
    header('location: ./index.php');
}
//if the above code is false then the HTML below will be displayed

// Check if the announcement ID is provided in the URL
if (isset($_GET['id'])) {
    $eventAnnouncementID = $_GET['id'];

    // Include necessary files and classes
    require_once '../classes/announcement.class.php';

    // Create a new instance of the announcement class
    $announcement = new Announcement();

    // Call a method to delete the announcement by ID
    if ($announcement->delete($eventAnnouncementID)) {
        // Announcement deleted successfully, redirect to the announcements page
        header("Location: ../webpages/events.php?librarianID=" . $_SESSION['librarianID']); // Redirect to announcements tab

        exit();
    } else {
        // An error occurred during deletion
        echo 'Error deleting announcement.';
        exit();
    }
} else {
    // Announcement ID is not provided in the URL
    echo 'Invalid request.';
    exit();
}
?>