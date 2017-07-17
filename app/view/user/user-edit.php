<h1 class="page-header">
    User <?php echo $alm->id != null ? '<i>'.$alm->name.'</i> - Edit User' : ' - New Register'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=User">Users</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->name : 'New Register'; ?></li>
</ol>

<form id="frm-User" action="?c=User&a=Save" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $alm->name; ?>" class="form-control" placeholder="Your name"/>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $alm->username; ?>" class="form-control" placeholder="Your username"/>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $alm->password; ?>" class="form-control" placeholder="Your password"/>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $alm->email; ?>" class="form-control" placeholder="Your email"/>
    </div>

    <div class="form-group">
        <label>Role
        <select class="form-control" id="selRole" name="role">
            <option value="0"></option>
            <?php foreach($roles as $role): ?>
                <?php ($role->id == $current_role_id) ? $selected = "selected" : $selected = "" ; ?>
                <option value="<?php echo $role->id; ?>" <?php echo $selected ?> >
                  <?php echo $role->role; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Save</button>
    </div>
</form>
