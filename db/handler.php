<?php
include "config.php";

class DBHandler
{
  private mysqli $db;

  function __construct()
  {
    $this->db = mysqli_connect(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$this->db) {
      echo "Error: " . mysqli_connect_errno() . " " . mysqli_connect_error();
      mysqli_close($this->db);
      exit;
    }
    mysqli_query($this->db, "SET NAMES 'utf8'");
  }

  function __destruct()
  {
    mysqli_close($this->db);
  }

  public function create_user(string $username, string $password, string $role): bool
  {
    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    return mysqli_query($this->db, $query);
  }

  public function find_all_users(): mysqli_result
  {
    $query = "SELECT * FROM user";
    return mysqli_query($this->db, $query);
  }

  public function find_user(string $username): mysqli_result
  {
    $query = "SELECT * FROM user WHERE username='$username'";
    return mysqli_query($this->db, $query);
  }

  public function find_user_by_id(string $user_id): mysqli_result
  {
    $query = "SELECT * FROM user WHERE id='$user_id'";
    return mysqli_query($this->db, $query);
  }

  public function find_all_workers(): mysqli_result
  {
    $query = "SELECT * FROM user WHERE role='worker'";
    return mysqli_query($this->db, $query);
  }

  public function find_avg_ticket_rating(string $user_id): mysqli_result
  {
    $query = "SELECT AVG(rating) AS avg_rating FROM ticket WHERE assigned_to='$user_id'";
    return mysqli_query($this->db, $query);
  }

  public function create_ticket(string $issued_by, string $category): bool
  {
    $query = "INSERT INTO ticket (category, issued_by) VALUES ('$category', '$issued_by')";
    return mysqli_query($this->db, $query);
  }

  public function assign_ticket(string $ticket, string $user_id): bool
  {
    $query = "UPDATE ticket SET assigned_to='$user_id' WHERE id='$ticket'";
    return mysqli_query($this->db, $query);
  }

  public function rate_ticket(string $ticket, int $rate): bool
  {
    $query = "UPDATE ticket SET rating='$rate' WHERE id='$ticket'";
    return mysqli_query($this->db, $query);
  }

  public function find_ticket_by_id(string $user_id): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE id='$user_id'";
    return mysqli_query($this->db, $query);
  }

  public function find_last_ticket(string $issued_by): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE issued_by='$issued_by' ORDER BY id DESC LIMIT 1";
    return mysqli_query($this->db, $query);
  }

  public function find_user_tickets(string $user_id): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE issued_by='$user_id'";
    return mysqli_query($this->db, $query);
  }

  public function find_worker_tickets(string $user_id): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE assigned_to='$user_id'";
    return mysqli_query($this->db, $query);
  }

  public function find_unassigned_tickets(): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE assigned_to IS NULL";
    return mysqli_query($this->db, $query);
  }

  public function find_assigned_tickets(): mysqli_result
  {
    $query = "SELECT * FROM ticket WHERE assigned_to IS NOT NULL";
    return mysqli_query($this->db, $query);
  }

  public function find_all_tickets(): mysqli_result
  {
    $query = "SELECT * FROM ticket";
    return mysqli_query($this->db, $query);
  }

  public function create_ticket_message(string $ticket, string $created_by, string $content): bool
  {
    $query = "INSERT INTO message (ticket, created_by, content) VALUES ('$ticket', '$created_by', '$content')";
    return mysqli_query($this->db, $query);
  }

  public function find_ticket_messages(string $ticket_id): mysqli_result
  {
    $query = "SELECT * FROM message WHERE ticket='$ticket_id' ORDER BY timestamp ASC";
    return mysqli_query($this->db, $query);
  }
}
