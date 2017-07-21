<h1 class="page-header">
    Permission <?php echo $alm->id != null ? '<i>'.$alm->permission.'</i> - Edit Permission' : ' - New Register'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Permission">Permissions</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->permission : 'New Register'; ?></li>
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

<a href="?c=Permission" class="btn btn-primary" role="button">Continue</a>