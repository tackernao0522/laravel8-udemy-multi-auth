$(function () {
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '削除してよろしいですか？',
            text: "削除すると元に戻せなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '削除する'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    '削除しました。',
                    'success'
                )
            }
        })
    });
});

// confirm
$(function () {
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '確認済にしてよろしいですか？',
            text: "一度確認済にすると、再度保留中にすることはできなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確認済にする'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    '確認済!',
                    '確認済にしました。',
                    'success'
                )
            }
        })
    });
});

// processing
$(function () {
    $(document).on('click', '#processing', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '対応中にしてよろしいですか？',
            text: "一度対応中にすると、再度確認済にすることはできなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '対応中にする'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    '対応中!',
                    '対応中にしました。',
                    'success'
                )
            }
        })
    });
});

// picked
$(function () {
    $(document).on('click', '#picked', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '発送可能にしてよろしいですか？',
            text: "一度発送可能にすると、再度対応中にすることはできなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '発送可能にする'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    '発送可能!',
                    '発送可能にしました。',
                    'success'
                )
            }
        })
    });
});

// picked
$(function () {
    $(document).on('click', '#shipped', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '発送済にしてよろしいですか？',
            text: "一度発送済にすると、再度発送可能にすることはできなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '発送済にする'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    '発送済!',
                    '発送済にしました。',
                    'success'
                )
            }
        })
    });
});

// delivered
$(function () {
    $(document).on('click', '#delivered', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: '配達完了にしてよろしいですか？',
            text: "一度配達完了にすると、再度発送済にすることはできなくなります。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '配達完了にする'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    '配達完了!',
                    '配達完了にしました。',
                    'success'
                )
            }
        })
    });
});
