function onlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function onlyChar(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode <= 13 || charCode == 32) {
        return true;
    } else {
        var keyChar = String.fromCharCode(charCode);
        var re = /^[a-zA-Z]+$/
        return re.test(keyChar);
    }
}

function alertValidate(text) {
    var alert = document.getElementById('alertValidate');
    alert.innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" + text + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function alertValidateTransaksi(text) {
    var alert = document.getElementById('alertValidateTransaksi');
    alert.innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" + text + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function validateCustomer() {
    var kode_customer = document.getElementById('kode_customer').value;
    var nama_customer = document.getElementById('nama_customer').value;
    var telp = document.getElementById('telp').value;
    if (kode_customer == "" || nama_customer == "" || telp == "") {
        alertValidate("Pastikan semua kolom terisi!");
        return false;
    } else if (kode_customer.length > 10) {
        alertValidate("Kode Customer tidak boleh lebih dari 10 karakter!");
        return false;
    } else if (nama_customer.length > 100) {
        alertValidate("Nama Customer tidak boleh lebih dari 100 karakter!");
        return false;
    } else if (telp.length > 20) {
        alertValidate("No Telp tidak boleh lebih dari 20 karakter!");
        return false;
    } else {
        return true;
    }
}

function validateBarang() {
    var kode_barang = document.getElementById('kode_barang').value;
    var nama_barang = document.getElementById('nama_barang').value;
    var harga_barang = document.getElementById('harga_barang').value;
    if (kode_barang == "" || nama_barang == "" || harga_barang == "") {
        alertValidate("Pastikan semua kolom terisi!");
        return false;
    } else if (kode_barang.length > 10) {
        alertValidate("Kode Barang tidak boleh lebih dari 10 karakter!");
        return false;
    } else if (nama_barang.length > 100) {
        alertValidate("Nama Barang tidak boleh lebih dari 100 karakter!");
        return false;
    } else if (harga_barang <= 0) {
        alertValidate("Harga barang harus lebih dari 0!");
        return false;
    } else {
        return true;
    }
}

function selectCustomer(kodeCustomer, namaCustomer, telpCustomer) {
    var kode_customer = document.getElementById('kode_customer');
    var nama_customer = document.getElementById('nama_customer');
    var telp = document.getElementById('telp');
    kode_customer.value = kodeCustomer;
    nama_customer.value = namaCustomer;
    telp.value = telpCustomer;
}

function selectBarang(val) {
    var myval = val.split('-');
    document.getElementById('nama_barang').value = myval[0];
    document.getElementById('harga_bandrol').value = myval[1];
}

function validateTransaksi() {
    var tgl = document.getElementById('tgl').value;
    var kode_customer = document.getElementById('kode_customer').value;
    var subtotal = document.getElementById('subtotal').value;
    var diskon = document.getElementById('diskon').value;
    var ongkir = document.getElementById('ongkir').value;
    var total_bayar = document.getElementById('total_bayar').value;

    if (tgl == "" || kode_customer == "" || subtotal == "" || diskon == "" || ongkir == "" || total_bayar == "") {
        alertValidate("Pastikan semua kolom terisi!");
        return false;
    } else {
        return true;
    }
}

function addRow() {
    var e = document.getElementById("kode_barang");
    var kode_barang = e.options[e.selectedIndex].text;
    var nama_barang = document.getElementById('nama_barang').value;
    var qty = document.getElementById('qty').value;
    var harga_bandrol = document.getElementById('harga_bandrol').value;
    var diskon_pct = document.getElementById('diskon_pct').value;
    var diskon_nilai = document.getElementById('diskon_nilai').value;
    var harga_diskon = document.getElementById('harga_diskon').value;
    var total = document.getElementById('total').value;
    if (kode_barang == "" || nama_barang == "") {
        alertValidateTransaksi("Pastikan kode barang terisi!");
        document.getElementById('modalTransaksi').removeAttribute('data-dismiss');
    } else if (qty == 0) {
        alertValidateTransaksi("Quantity harus lebih dari 0!");
        document.getElementById('modalTransaksi').removeAttribute('data-dismiss');
    } else if (harga_bandrol == 0) {
        alertValidateTransaksi("Harga Bandrol harus lebih dari 0!")
        document.getElementById('modalTransaksi').removeAttribute('data-dismiss');
    } else if (total == 0) {
        alertValidateTransaksi("Total harus lebih dari 0!");
        document.getElementById('modalTransaksi').removeAttribute('data-dismiss');
    } else {
        $('#tableBarang').append('<tr id="rowBarang">\
                                    <td><input type="text" name="kode_barang[]" class="form-control-plaintext" value="'+ kode_barang + '" readonly></td>\
                                    <td><input type="text" name="nama_barang[]" class="form-control-plaintext" value="'+ nama_barang + '" readonly></td>\
                                    <td><input type="text" name="qty[]" class="form-control-plaintext" value="'+ qty + '" readonly></td>\
                                    <td><input type="text" name="harga_bandrol[]" class="form-control-plaintext" value="'+ harga_bandrol + '" readonly></td>\
                                    <td><input type="text" name="diskon_pct[]" class="form-control-plaintext" value="'+ diskon_pct + '" readonly></td>\
                                    <td><input type="text" name="diskon_nilai[]" class="form-control-plaintext" value="'+ diskon_nilai + '" readonly></td>\
                                    <td><input type="text" name="harga_diskon[]" class="form-control-plaintext" value="'+ harga_diskon + '" readonly></td>\
                                    <td><input type="text" name="total[]" id="total_arr[]" class="form-control-plaintext" value="'+ total + '" readonly></td>\
                                    <td><button class="btn btn-sm btn-danger" id="removeRow"><span class="fas fa-trash"></span></button></td>\
                                </tr >\
                            ');
        document.getElementById('kode_barang').value = "";
        document.getElementById('nama_barang').value = "";
        document.getElementById('qty').value = "0";
        document.getElementById('harga_bandrol').value = "0";
        document.getElementById('diskon_pct').value = "0";
        document.getElementById('diskon_nilai').value = "0";
        document.getElementById('harga_diskon').value = "0";
        document.getElementById('total').value = "0";
        document.getElementById('modalTransaksi').setAttribute('data-dismiss', 'modal');

        var sum = 0;
        var total_arr = document.getElementsByName('total[]');
        for (var i = 0; i < total_arr.length; i++) {
            sum += parseInt(total_arr[i].value);
        }
        document.getElementById('subtotal').value = sum;

        var diskon = parseInt(document.getElementById('diskon').value);
        var ongkir = parseInt(document.getElementById('ongkir').value);
        document.getElementById('total_bayar').value = sum - diskon + ongkir;
    }

}

$(document).ready(function () {
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#rowBarang').remove();
        var sum = 0;
        var total_arr = document.getElementsByName('total[]');
        for (var i = 0; i < total_arr.length; i++) {
            sum += parseInt(total_arr[i].value);
        }
        document.getElementById('subtotal').value = sum;

        var diskon = parseInt(document.getElementById('diskon').value);
        var ongkir = parseInt(document.getElementById('ongkir').value);
        document.getElementById('total_bayar').value = sum - diskon + ongkir;
    });
})

function totalBayar() {
    var sum = 0;
    var total_arr = document.getElementsByName('total[]');
    for (var i = 0; i < total_arr.length; i++) {
        sum += parseInt(total_arr[i].value);
    }
    document.getElementById('subtotal').value = sum;

    var diskon = parseInt(document.getElementById('diskon').value);
    var ongkir = parseInt(document.getElementById('ongkir').value);
    document.getElementById('total_bayar').value = sum - diskon + ongkir;
}

function total() {
    var qty = parseInt(document.getElementById('qty').value);
    var harga_bandrol = parseInt(document.getElementById('harga_bandrol').value);
    var diskon_pct = parseInt(document.getElementById('diskon_pct').value);
    var diskon_nilai = parseInt(document.getElementById('diskon_nilai').value);
    document.getElementById('diskon_nilai').value = harga_bandrol * (diskon_pct / 100);
    document.getElementById('harga_diskon').value = harga_bandrol - (harga_bandrol * (diskon_pct / 100));
    document.getElementById('total').value = (harga_bandrol * qty) - ((harga_bandrol * (diskon_pct / 100)) * qty);
}