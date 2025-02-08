<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Kategori </h3>
    </div>

    <form action="<?= base_url('kategori/update/' . $kategori['id']) ?>" method="post">
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="<?= esc($kategori['nama_kategori']) ?>" required>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="<?= esc($kategori['keterangan']) ?>" required>
        </div>
        <div class="form-group">
            <label>Fitur (JSON Editor)</label>
            <div id="json-editor" style="height: 300px;"></div>
            <input type="hidden" name="fitur" id="json-input">
        </div>
        <button type="submit" class="btn btn-success" onclick="saveJSON()">Simpan Perubahan</button>
        <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.0/jsoneditor.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.0/jsoneditor.min.js"></script>

<script>
    var container = document.getElementById("json-editor");
    var options = { mode: "tree", modes: ["tree", "form", "code"] };
    var json = <?= json_encode($kategori['fitur'] ?: new stdClass(), JSON_PRETTY_PRINT) ?>;
    var editor = new JSONEditor(container, options, json);

    function saveJSON() {
        var jsonInput = document.getElementById("json-input");
        jsonInput.value = JSON.stringify(editor.get(), null, 2);
    }
</script>

<?= $this->endSection() ?>
