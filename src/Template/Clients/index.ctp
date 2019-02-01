<h2>Список клиентов</h2>
<?= $this->Flash->render() ?>
<div class="row">
    <i>Нажмите на пользователя, чтобы отредактировать или удалить его</i>
    <div class="col-lg-8 col-md-12 col-sm-12" id="clients-table-container">        
        <table class="table-bordered" id="clients-table">
            <tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Тел.</th>
                <th>E-Mail</th>
            </tr>
            <?php foreach ($clients as $client) : ?>
            <tr>
                <td hidden><?= $client->id ?></td>
                <td><?= isset($client->lastname) ? $client->lastname : ''; ?></td>
                <td><?= isset($client->firstname) ? $client->firstname : ''; ?></td>
                <td><?= isset($client->middlename) ? $client->middlename : ''; ?></td>
                <td><?= isset($client->phone) ? $client->phone : ''; ?></td>
                <td><?= isset($client->email) ? $client->email : ''; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="form-container col-lg-4 col-md-12 col-sm-12">
        <i>* - обязательные для заполнения поля</i>
        <?= $this->Form->create($client, ['class' => 'client-form', 'type' => 'post', 'url' => '/clients/add']) ?>
            
            <!-- <input type="text" name="id" id="id" class="form-control" hidden> -->
            <?= $this->Form->control('id', ['hidden', 'id' => 'id', 'class' => 'form-control', 'label' => false]); ?>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Фамилия*</span>
                </div>
                <?= $this->Form->control('lastname', ['id' => 'lastname', 'class' => 'form-control', 'label' => false, 'templates' => ['inputContainer' => '{{content}}'], 'required', 'value' => '']); ?>
                <!-- <input type="text" name="lastname" id="lastname" class="form-control" required> -->
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Имя*</span>
                </div>
                <?= $this->Form->control('firstname', ['id' => 'firstname', 'class' => 'form-control', 'label' => false, 'templates' => ['inputContainer' => '{{content}}'], 'required', 'value' => '']); ?>
                <!-- <input type="text" name="firstname" id="firstname" class="form-control" required> -->
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Отчество</span>
                </div>
                <?= $this->Form->control('middlename', ['id' => 'middlename', 'class' => 'form-control', 'label' => false, 'templates' => ['inputContainer' => '{{content}}'], 'value' => '']); ?>
                <!-- <input type="text" name="middlename" id="middlename" class="form-control"> -->
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Тел.*</span>
                </div>
                <?= $this->Form->control('phone', ['id' => 'phone', 'class' => 'form-control', 'label' => false, 'templates' => ['inputContainer' => '{{content}}'], 'required', 'value' => '']); ?>
                <!-- <input type="text" name="phone" id="phone" class="form-control" required> -->
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                </div>
                <?= $this->Form->control('email', ['id' => 'email', 'class' => 'form-control', 'label' => false, 'templates' => ['inputContainer' => '{{content}}'], 'value' => '']); ?>
                <!-- <input type="text" name="email" id="email" class="form-control"> -->
            </div>

            <?= $this->Form->button(__('Добавить'), ['class'=>'btn btn-primary btn-add']) ?>
            <?= $this->Form->button(__('Редактировать'), ['class'=>'btn btn-primary btn-edit']) ?>
            <?= $this->Form->button(__('Удалить'), ['class'=>'btn btn-primary btn-delete']) ?>
        <?= $this->Form->end(); ?>
    </div>
</div>