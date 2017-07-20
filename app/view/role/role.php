<h1 class="page-header">Roles</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Role&a=Crud">New Role</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Role</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->getRoles() as $r): ?>
        <tr>
            <td><?php echo $r->role; ?></td>
            <td>
                <a href="?c=Role&a=Crud&id=<?php echo $r->id; ?>">Edit</a>
            </td>
            <td>
                <a href="?c=Role&a=SetPermissions&id=<?php echo $r->id; ?>">Set Permissions</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('Are you sure to delete this register?');" href="?c=Role&a=Delete&id=<?php echo $r->id; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
