<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientsInterest $clientsInterest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clients Interest'), ['action' => 'edit', $clientsInterest->client_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clients Interest'), ['action' => 'delete', $clientsInterest->client_id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsInterest->client_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients Interests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clients Interest'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Interests'), ['controller' => 'Interests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Interest'), ['controller' => 'Interests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientsInterests view large-9 medium-8 columns content">
    <h3><?= h($clientsInterest->client_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientsInterest->has('client') ? $this->Html->link($clientsInterest->client->id, ['controller' => 'Clients', 'action' => 'view', $clientsInterest->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interest') ?></th>
            <td><?= $clientsInterest->has('interest') ? $this->Html->link($clientsInterest->interest->id, ['controller' => 'Interests', 'action' => 'view', $clientsInterest->interest->id]) : '' ?></td>
        </tr>
    </table>
</div>
