function fetchPopupFormActions(popupName) {
    //document.querySelector('.apply-form-btn')
    document.addEventListener('click', (e) => {
        if (e.target.closest('.apply-form-btn')){
            
            if (popupName === 'admin_add') {
                e.preventDefault();

                formData = {
                    'cli_id': document.querySelector('input[id="cli_id"]').value,
                    'cli_name_f':  document.querySelector('.form-input[id="cli_name_f"]').value,
                    'cli_name_i' : document.querySelector('.form-input[id="cli_name_i"]').value,
                    'cli_name_o' : document.querySelector('.form-input[id="cli_name_o"]').value,
                    'cli_prof' : document.querySelector('.form-input[id="cli_prof"]').value,
                    'cli_div_id' : parseInt(document.querySelector('.form-input[id="cli_div_id"]').value),
                    'cli_comment' : document.querySelector('.form-input[id="cli_comment"]').value,
                    'cli_date_born' : document.querySelector('.form-input[id="cli_date_born"]').value,
                    'cli_sex' : parseInt(document.querySelector('.form-input[id="cli_sex"]').value),
                    'cli_email' : document.querySelector('.form-input[id="cli_email"]').value,
                    'cli_tel_mobile' : document.querySelector('.form-input[id="cli_tel_mobile"]').value,
                    'cli_tel_work' : document.querySelector('.form-input[id="cli_tel_work"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_tel_work2' : document.querySelector('.form-input[id="cli_tel_work2"]').value,
                    'cli_disable' : document.querySelector('.form-input[id="cli_disable"]').checked === true ? 1 : 0,
                    'cli_sync_1c' : document.querySelector('.form-input[id="cli_sync_1c"]').checked === true ? 1 : 0,
                };

                console.log('data:', formData);
                // поменять url
                fetch(`/PopupaddEquipment/equipmentAddDynamicPost`, {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                    body: new URLSearchParams(formData),
                    // body: new URLSearchParams({ u_login: data['u_login'], u_password: data['u_password']}),
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelectorAll('.form-valid-error').forEach(el => el.textContent = '');

                    if (data.success) {
                        console.log('Вы успешно отправили запрос');
                        window.popupAPI.close();

                    }

                    if (data.errors) {
                        console.log('data.errors', data.errors);
                        for (const [field, messages] of Object.entries(data.errors)) {
                            // span имеет id равный имени поля: login / password
                            const el = document.querySelector(`.form-valid-error[data-field="${field}"]`);
                            if (el) el.textContent = messages[0];
                        }
                        // alert('Вы не авторизованы. Введены неверные данные.')
                    }
                })
                .catch(() => {
                    console.log(`Ошибка отправки данных в окошке "${popupName}"`);
                });
            } 

        }

    });

}