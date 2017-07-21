<h1 class="page-header">
    Role <?php echo $alm->id != null ? '<i>'.$alm->role.'</i> - Edit Role' : ' - New Register'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Role">Roles</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->role : 'New Register'; ?></li>
</ol>

<form id="frm-Role" action="?c=Role&a=Save" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" value="<?php echo $alm->role; ?>" class="form-control" placeholder="Role" data-validacion-tipo="requerido|min:3" />
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Save</button>
        <a href="?c=Role" class="btn btn-primary" role="button">Cancel</a>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-Role").submit(function(){
            return $(this).validate();
        });
    })
</script>
