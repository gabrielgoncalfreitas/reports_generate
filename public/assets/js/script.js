const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// Ajax to create a profile
function ajaxProfile() {
    const first_name = document.querySelector('input[name=first_name]').value;
    const last_name = document.querySelector('input[name=last_name]').value;
    const dbo = document.querySelector('input[name=dbo]').value;
    const gender = document.querySelector('select[name=gender]').value;

    disable();

    $.ajax({
        url: '/api/profiles/create',
        type: 'PUT',
        data: {
            first_name: first_name,
            last_name: last_name,
            dbo: dbo,
            gender: gender
        },
        success: function (data) {
            alert(data);
            location.reload();
        }
    });
}

// Ajax to create a report
function ajaxReport() {
    const title = document.querySelector('input[name=title]').value;
    const description = document.querySelector('textarea[name=description]').value;

    disable();

    $.ajax({
        url: '/api/reports/create',
        type: 'PUT',
        data: {
            title: title,
            description: description
        },
        success: function (data) {
            location.href = data;
        },
        error: function () {
            enable();
        }
    });
}

// Ajax to link the profile on report
function addProfile() {
    const report_id = document.querySelector('input[name=report_id]');
    const profile_id = document.querySelector('select[name=profile_id]');
    const alert = document.querySelector('.alert');
    const alertText = document.querySelector('.alert-text');

    if (profile_id.value == 'null') {
        alertText.innerText = 'Select a profile!';
        alert.hidden = false;
    } else {
        $.ajax({
            url: '/api/reports/linkprofile/link',
            type: 'PUT',
            data: {
                report_id: report_id.value,
                profile_id: profile_id.value
            },
            success: function (data) {
                if (data == 'Profile already linked!') {
                    alertText.innerText = 'Profile already linked!';
                    alert.hidden = false;
                } else {
                    location.reload();
                }
            }
        });
    }
}

// Function to disable inputs, selects and buttons while ajax is running
function disable() {
    document.querySelectorAll('.ajaxDisabled').forEach(element => {
        element.disabled = true;
    });

    document.querySelector('.spinner-border').style.visibility = 'visible';
}
