<tr>
    <th>Текст</th>
    <th>Комментарий</th>
    <th>Дата</th>
    <th>Статус</th>
</tr>
<?php if (isset($result)) : ?>
    <?php foreach ($result as $interest) : ?>
    <tr>
        <td class="interest-id" hidden>
            <?= isset($interest['id']) ? $interest['id'] : '' ?>
        </td>        
        <td>
            <?= isset($interest['text']) ? $interest['text'] : '' ?>
        </td>
        <td>
            <?= isset($interest['comment']) ? $interest['comment'] : '' ?>
        </td>            
        <td>
            <?= isset($interest['created_at']) ? $interest['created_at'] : '' ?>
        </td>
        <td hidden>
            <?= isset($interest['status_id']) ? $interest['status_id'] : '' ?>
        </td>
        <td>
            <span class="badge badge<?= $interest['status_classname'] ?>">
                <?= $interest['status_name'] ?>
            </span>
        </td>
        <td>
            <i class="fas fa-edit interest-edit" data-toggle="modal" data-target="#interest-form-modal"></i>
            <i class="fas fa-trash-alt interest-delete" data-toggle="modal" data-target="#delete-confirm-modal"></i>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>