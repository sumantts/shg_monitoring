

<div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="assets/images/mohila-bikash-small.png" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?=$_SESSION["StfNm"]?></p>
                  <!--<p class="designation">Premium user</p>-->
                </div>
              </a>
            </li>
            <!--<li class="nav-item nav-category">Main Menu</li>-->
            <li class="nav-item <?php if($p == 'dashboard' || $p == 'dashboard-more'){?>active<?php } ?>">
              <a class="nav-link" href="?p=dashboard">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'group-list'){?>active<?php } ?>">
              <a class="nav-link" href="?p=group-list">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Group List</span>
              </a>
            </li>
            <?php if($_SESSION["StfId"] == 99){?>
            <li class="nav-item <?php if($p == 'group-upload' || $p == 'member-upload'){?>active<?php } ?>">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Upload</span>
                <i class="menu-arrow"></i>
              </a>
              <div <?php if($p == 'group-upload' || $p == 'member-upload'){?>class="collapse show"<?php }else{?>class="collapse"<?php } ?> id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="?p=group-upload">Group Upload</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?p=member-upload">Member Upload</a>
                  </li>
                </ul>
              </div>
            </li>
            <?php } ?>
            <li class="nav-item <?php if($p == 'opening-data'){?>active<?php } ?>">
              <a class="nav-link" href="?p=opening-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Opening Data</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'meeting-data' || $p == 'meeting-data-report'){?>active<?php } ?>">
              <a class="nav-link" href="?p=meeting-data">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Meeting Data</span>
              </a>
            </li>

            <li class="nav-item <?php if($p == 'interest-receipt'){?>active<?php } ?>">
              <a class="nav-link" href="?p=interest-receipt">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Interest Receipt</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'voucher-entry'){?>active<?php } ?>">
              <a class="nav-link" href="?p=voucher-entry">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Voucher Entry</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'cash-book'){?>active<?php } ?>">
              <a class="nav-link" href="?p=cash-book">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Cash Book</span>
              </a>
            </li>
            <li class="nav-item <?php if($p == 'link-group'){?>active<?php } ?>">
              <a class="nav-link" href="?p=link-group">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Link Group</span>
              </a>
            </li>

            <li class="nav-item <?php if($p == 'link-member'){?>active<?php } ?>">
              <a class="nav-link" href="?p=link-member">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title"> Link Member</span>
              </a>
            </li>

            <?php if($_SESSION["StfId"] == 99){?>
            <li class="nav-item <?php if($p == 'data-export'){?>active<?php } ?>">
              <a class="nav-link" href="?p=data-export">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Data Export</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item <?php if($p == 'change-password'){?>active<?php } ?>">
              <a class="nav-link" href="?p=change-password">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Change Password</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?p=login&out=ok">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Sign Out</span>
              </a>
            </li>
          </ul>
        </nav>