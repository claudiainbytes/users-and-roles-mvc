<h1 class="page-header">
    User <?php echo $alm->id != null ? '<i>'.$alm->name.'</i> - Edit User' : ' - New Register '; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=User">Users</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->name : 'New Register'; ?></li>
</ol>


<div class="alert alert-danger" role="alert">
  <h3 class="alert-heading">Warning!</h3>
  <p class="mb-0"></p>
  <ul>
  <?php if(isset($validation)){
            foreach ($validation as $v){
                echo "<li>$v</li>";
            }
        }
  ?>
  </ul>
</div>

<a href="?c=User" class="btn btn-primary" role="button">Continue</a>