<h2>Список интересов клиентов</h2>

<i>Нажмите на пользователя, чтобы увидеть список его интересов</i>
<div class="interests" id="clients-table-container">        
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

<button class="btn" id="btn-add-interest" data-toggle="modal" data-target="#interest-form-modal">Добавить интерес</button>

<div id="interests-table-container">
    <div class="preloader"><img src="/img/spinner.gif"></div>
    
    <table class="table-bordered" id="interests-table">            
    </table>

</div>


<!-- Modal window for adding and editing interests -->
<div class="modal" id="interest-form-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              
        <i>* - обязательные для заполнения поля</i>
        <?= $this->Form->create($interest, ['data-parsley-validate'=>'', 'id' => 'interests-form', 'type' => 'post']) ?>
                        
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Текст*</span>
                </div>
                <textarea rows="3" name="text" id="text" class="form-control" required></textarea>
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Комментарий</span>
                </div>
                <textarea rows="3" name="comment" id="comment" class="form-control"></textarea>
            </div>
            
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Дата*</span>
                </div>                
                <input type="date" name="created_at" id="created-at" class="form-control" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Статус*</span>
                </div>                
                <select name="status_id" id="status-select" class="custom-select" required>
                    <option value="" selected>Выберите статус...</option>
                    <?php foreach ($statuses as $status) : ?>
                        <option value="<?= $status->id ?>">
                            <?= $status->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?= $this->Form->button(__('Добавить интерес'), ['class' => 'btn btn-primary btn-add']) ?>
            <?= $this->Form->button(__('Обновить интерес'), ['class' => 'btn btn-primary btn-edit']) ?>
            <?= $this->Form->button(__('Закрыть'), ['class' => 'btn btn-secondary', 'data-dismiss'=>'modal']) ?>
        <?= $this->Form->end(); ?>

      </div>
    </div>
  </div>
</div>


<!-- Modal for deleteing confirmation -->
<div class="modal fade" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="delete-confirm-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы уверены, что хотите удалить клиентский интерес?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delete-confirm">Да, уверен</button>
        <button type="button" class="btn btn-secondary delete-dismiss" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>