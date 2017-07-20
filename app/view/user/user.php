<h1 class="page-header">Users</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=User&a=Crud">New User</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">User</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->getUsers() as $r): ?>
        <tr>
            <td><?php echo $r->name; ?></td>
            <td>
                <a href="?c=User&a=Crud&id=<?php echo $r->id; ?>">Edit</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('Are you sure to delete this register?');" href="?c=User&a=Delete&id=<?php echo $r->id; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
