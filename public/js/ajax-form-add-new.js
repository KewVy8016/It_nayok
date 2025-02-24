$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Validate on input change
    $('input[name="title"], textarea[name="content"]').on('input', function() {
        validateField($(this));
    });

    // Validate on blur (เมื่อออกจาก input)
    $('input[name="title"], textarea[name="content"]').on('blur', function() {
        if ($(this).val().trim() === '') {
            $(this).next('.alert').remove();
            $(this).after(`<div class="alert alert-danger mt-2 mb-3">กรุณากรอก${$(this).attr('name') === 'title' ? 'ชื่อข่าว' : 'รายละเอียดข่าว'}</div>`);
        }
    });

    $('#image-upload').change(function() {
        validateImage();
    });

    function validateField($field) {
        $field.next('.alert').remove();
        
        const value = $field.val().trim();
        if (!value) {
            $field.after(`<div class="alert alert-danger mt-2 mb-3">กรุณากรอก${$field.attr('name') === 'title' ? 'ชื่อข่าว' : 'รายละเอียดข่าว'}</div>`);
            return false;
        } else if (value.length > ($field.attr('name') === 'title' ? 100 : 255)) {
            $field.after(`<div class="alert alert-danger mt-2 mb-3">ห้ามกรอกเกิน ${$field.attr('name') === 'title' ? '100' : '255'} ตัวอักษร</div>`);
            return false;
        }
        return true;
    }

    function validateImage() {
        $('#drop-zone').next('.alert').remove();
        const file = $('#image-upload').prop('files')[0];
        
        if (!file) {
            $('#drop-zone').after('<div class="alert alert-danger mt-2 mb-3">กรุณาเลือกรูปภาพ</div>');
            return false;
        }
        
        if (file.size > 2 * 1024 * 1024) {  // 2MB
            $('#drop-zone').after('<div class="alert alert-danger mt-2 mb-3">ห้ามอัปโหลดไฟล์เกิน 2 MB</div>');
            return false;
        }
        
        return true;
    }

    // Form submit
    $('form').submit(function(e) {
        e.preventDefault();
        $('.alert').remove();
        
        let hasError = false;
        const title = $('input[name="title"]').val().trim();
        const content = $('textarea[name="content"]').val().trim();
        
        if (!title || title === '') {
            $('input[name="title"]').after('<div class="alert alert-danger mt-2 mb-3">กรุณากรอกชื่อข่าว</div>');
            hasError = true;
        } else if (title.length > 100) {
            $('input[name="title"]').after('<div class="alert alert-danger mt-2 mb-3">ห้ามกรอกเกิน 100 ตัวอักษร</div>');
            hasError = true;
        }
        
        if (!content || content === '') {
            $('textarea[name="content"]').after('<div class="alert alert-danger mt-2 mb-3">กรุณากรอกรายละเอียดข่าว</div>');
            hasError = true;
        } else if (content.length > 255) {
            $('textarea[name="content"]').after('<div class="alert alert-danger mt-2 mb-3">ห้ามกรอกเกิน 255 ตัวอักษร</div>');
            hasError = true;
        }
        
        if (!$('#image-upload').prop('files').length) {
            $('#drop-zone').after('<div class="alert alert-danger mt-2 mb-3">กรุณาเลือกรูปภาพ</div>');
            hasError = true;
        }
        
        if (!hasError) {
            $.ajax({
                url: '/insert',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
            });
        }
    });

    // Image preview code remains the same...
});