<h1 class="page-header">
  Role <?php echo $role->id != null ? '<i>'.$role->role.'</i>' : ''; ?> - Set Permissions
</h1>

<form id="frm-RoleSetPermissions" action="?c=Role&a=SavePermissions" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $role->id; ?>" />

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Permission&a=Crud">New Permission</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Permissions</th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 0;
        foreach($permissions as $p): ?>
        <?php
            $checked = "";
            if($i < count($rolePermissions)){
              if(!empty($rolePermissions)){
                  if($rolePermissions[$i]->permission_id == $p->id){
                    $checked = "checked";
                    $i++;
                  }
                }
              }
        ?>
        <tr>
            <td><?php echo $p->permission; ?></td>
            <td>
                <input type="checkbox" name="permissions[]" value="<?php echo $p->id; ?>" <?php echo $checked; ?> >
            </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
</table>

<div class="well well-sm text-right">
    <button class="btn btn-success">Save Permissions</button>
</div>

</form>
