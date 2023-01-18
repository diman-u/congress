<div class="field">
    <label class="label">Укажите название вашего учреждения</label>
    <div class="control">  
        <input type="text" x-model="form.organization">
    </div>
    <p class="help">Заполните поле, если заявка подается от организации</p>
</div>

<h3 class="mt-3 mb-3">Участники проекта</h3>

<template x-for="(item, index) in participantList" :key="index">
    <div class="card card--actions">
        <div class="card__content">
            <div class="mb-1">
                <img class="img-fluid img-mh60" src="https://leader.orgzdrav.com/storage/app/resized/98b/48c/fd0/1-1650385666_resized_98b48cfd0e8cc34e448ee7f927ae72fe6d6b9d6f.jpeg" alt="">
            </div>
            <div class="card__title" x-text="item.name"></div>
            <div class="card__text">
                <div x-text="item.position"></div>
                <div x-text="item.city"></div>
            </div>
        </div>
        <div class="card__footer">
            <button class="btn btn--small" type="button" @click="removeParticipant(index)"><i class="fa-solid fa-trash"></i></button>
        </div>
    </div>
</template>

<div class="card">
    <div class="card__content">
        <div class="field">
            <label class="label">ФИО</label>
            <div class="control">  
                <input type="text" x-model="participant.name">
            </div>
            <p class="message message--danger message--small" x-show="error">Данное поле обязательно для участника</p>
        </div>
        <div class="field">
            <label class="label">Должность</label>
            <div class="control">  
                <input type="text" x-model="participant.position">
            </div>
            <p class="message message--danger message--small" x-show="error">Данное поле обязательно для участника</p>
        </div>
        <div class="field">
            <label class="label">Город</label>
            <div class="control">  
                <input type="text" x-model="participant.city">
            </div>
            <p class="message message--danger message--small" x-show="error">Данное поле обязательно для участника</p>
        </div>
        <div class="field">
            <div class="control">
                {% include '../../parts/filepond.twig' %} 
            </div>
            <p class="help">Объем файла до&nbsp;1&nbsp;мб</p>
        </div>
    </div>
    <div class="card__footer">
        <button class="btn" type="button">Добавить</button>
    </div>
</div>