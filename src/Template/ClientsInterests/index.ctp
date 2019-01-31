<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsInterest[]|\Cake\Collection\CollectionInterface $clientsInterests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Clients Interest'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Interests'), ['controller' => 'Interests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Interest'), ['controller' => 'Interests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientsInterests index large-9 medium-8 columns content">
    <h3><?= __('Clients Interests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interest_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientsInterests as $clientsInterest): ?>
            <tr>
                <td><?= $clientsInterest->has('client') ? $this->Html->link($clientsInterest->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsInterest->client->id]) : '' ?></td>
                <td><?= $clientsInterest->has('interest') ? $this->Html->link($clientsInterest->interest->id, ['controller' => 'Interests', 'action' => 'view', $clientsInterest->interest->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $clientsInterest->client_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientsInterest->client_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsInterest->client_id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsInterest->client_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
