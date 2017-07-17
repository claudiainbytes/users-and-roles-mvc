<h1 class="page-header">
    Permission <?php echo $alm->id != null ? '<i>'.$alm->permission.'</i> - Edit Permission' : ' - New Register'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Permission">Permissions</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->permission : 'New Register'; ?></li>
</ol>

<form id="frm-Permission" action="?c=Permission&a=Save" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

    <div class="form-group">
        <label>Permission</label>
        <input type="text" name="permission" value="<?php echo $alm->permission; ?>" class="form-control" placeholder="Permission" data-validacion-tipo="requerido|min:3" />
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Save</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-Permission").submit(function(){
            return $(this).validate();
        });
    })
</script>
