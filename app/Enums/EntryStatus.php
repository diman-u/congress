<?php

namespace App\Enums;

enum EntryStatusEnum: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case REJECTED = 2;
    case RETURNED = 3;

    public function readableStatus(): string
    {
        return match($this) 
        {
            EntryStatus::DRAFT => 'Черновик',   
            EntryStatus::PUBLISHED => 'Опубликовано',   
            EntryStatus::REJECTED => 'Отклонено',     
            EntryStatus::RETURNED => 'Возвращено на доработку',  
        };
    }
}