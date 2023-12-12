<?php

include("../db/function.php");
include("../db/connection.php");
$user_data = check_login($con);

?>

<div class="sidebar ">
    <div class="logo_details">
      <div class="logo_name">HOMEOWNER</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
  
      <li>
        <a href="../amo/index.php">
          <i class="bx bx-grid-alt"></i>
          <span class="link_name">Browse</span>
        </a>
        <span class="tooltip">Browse</span>
      </li>
      <li>
        <a href="../amo/amouser.php">
          <i class="bx bx-user"></i>
          <span class="link_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="../amo/amomessage.php">
          <i class="bx bx-chat"></i>
          <span class="link_name">Chats</span>
        </a>
        <span class="tooltip">Chats</span>
      </li>
    
      <li>
        <a href="../amo/amohistory.php">
          <i class="bx bx-folder"></i>
          <span class="link_name">History</span>
        </a>
        <span class="tooltip">History</span>
      </li>
      <li>
        <a href="../amo/amosettings.php">
          <i class="bx bx-cog"></i>
          <span class="link_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
      </li>
      <li class="profile"><a href="../login/logout.php">
        <div class="profile_details">
          <img src="../upload/65759e98a1769_download (10).jpg?>" alt="profile image">
          <div class="profile_content">
            <div class="name">Donny </div>
            <div class="designation">Homeowner</div>
          </div>
        </div>
        
        <i class="bx bx-log-out" id="log_out"></i>
</a>
      </li>
    </ul>
  </div>
  
  <!-- Scripts -->
  <script src="script.js"></script>