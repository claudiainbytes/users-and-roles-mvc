<h1 class="page-header">Permissions</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Permission&a=Crud">New Permission</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Permission</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->getPermissions() as $r): ?>
        <tr>
            <td><?php echo $r->permission; ?></td>
            <td>
                <a href="?c=Permission&a=Crud&id=<?php echo $r->id; ?>">Edit</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('Are you sure to delete this register?');" href="?c=Permission&a=Delete&id=<?php echo $r->id; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
