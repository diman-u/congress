<div class="split-route" x-data>
    <a href="{{ route('leader') }}" 
        class="split-route__item split-route__item--left bg-blue" 
        @mouseenter="$root.classList.add('split-route--left')" 
        @mouseleave="$root.classList.remove('split-route--left')"
    >
        <div class="container">
            <h2>Оргздрав: лидеры отрасли</h2>
            <p>Ежегодное мероприятие по выявлению лучших кейсов и награждению лидеров в сфере организации
            здравоохранения в регионах РФ</p>
        </div>
    </a>
    <a href="{{ route('orgzdrav') }}" 
        class="split-route__item split-route__item--right bg-blue" 
        @mouseenter="$root.classList.add('split-route--right')" 
        @mouseleave="$root.classList.remove('split-route--right')"
    >
        <div class="container">
            <h2>Конгресс оргздрав</h2>
            <p>Конгресс позволяет широко представить предложения по стратегическим и тактическим вопросам развития
            здравоохранения РФ.</p>
        </div>
    </a>
</div>