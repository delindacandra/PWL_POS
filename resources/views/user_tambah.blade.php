<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Uer</title>
    </head>
    <body>
        <h1>Form Tambah Data User</h1>
        <form method="post" action="tambah_simpan">
            {{csrf_field()}}
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukan Username">
            <br>
            <label> Nama </label>
            <input type="text" name="nama" placeholder="Masukkan Nama">
            <br>
            <label> Password </label>
            <input type="password" name="password" placeholder="Masukkan Password">
            <br>
            <label> level ID </label>
            <input type="text" name="level_id" placeholder="Masukkan ID Level">
            <br><br>
            <input type="submit" class="btn btn-success" value="Simpan">
        </form>
    </body>
</html>