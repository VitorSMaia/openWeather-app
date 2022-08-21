<div>
    <div class="flex flex-col justify-center items-center m-20">
        <div class="rounded-t-xl bg-gray-300 border-b-2 w-20 h-10 w-[500px] flex justify-center h-max ">
            <div class="m-5">
                <p>Tempo e Temperatura</p>
            </div>
        </div>
        <div class="h-max w-[500px] bg-gray-100">
            <div class="flex flex-col justify-center items-center m-10">

                <p>Cidade:</p>
                <p>{{ $response->weather['temp']['city'] }}</p>
                <p class="font-light text-xl">{{ $response->weather['data'] }}</p>

                <span class="material-symbols-rounded text-[200px]">
                    {{ $response->weather['temp']['icon'] }}
                </span>
                <p class="text-2xl font-light">{{ $response->weather['temp']['description'] }}</p>
                <p>{{ $response->weather['temp']['main']['temp_min'] }}°C / {{ $response->weather['temp']['main']['temp_max'] }}°C</p>
                <p>Umidade: {{ $response->weather['temp']['main']['humidity'] }}%</p>
                @foreach($response->weather['cord'] as $key => $cord)
                    {{$key .': '. $cord}}
                @endforeach
            </div>
        </div>
        <div class="rounded-b-xl bg-gray-300 border-t-2 w-20 h-max w-[500px]">
            <div class="m-5">
                <select class="w-full" name="" id="">
                    <option value="">Cidade 1</option>
                    <option value="">Cidade 1</option>
                    <option value="">Cidade 1</option>
                    <option value="">Cidade 1</option>
                    <option value="">Cidade 1</option>
                    <option value="">Cidade 1</option>
                </select>
            </div>
        </div>
    </div>
</div>
