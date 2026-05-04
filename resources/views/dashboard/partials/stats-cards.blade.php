<h3 class="text-lg font-bold dark:text-white border-l-4 border-indigo-500 pl-2">
    Minhas Estatísticas
</h3>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-indigo-500 text-center">
        <p class="text-xs text-gray-500 uppercase">Total Geral</p>
        <p class="text-3xl font-black dark:text-white">{{ $statsAppo['total'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-yellow-500 text-center">
        <p class="text-xs text-gray-500 uppercase">Hoje</p>
        <p class="text-3xl font-black dark:text-white">{{ $statsAppo['hoje'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-green-500 text-center">
        <p class="text-xs text-gray-500 uppercase">Concluídos</p>
        <p class="text-3xl font-black dark:text-white">{{ $statsAppo['concluidos'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-b-4 border-red-500 text-center">
        <p class="text-xs text-red-600 uppercase">Cancelados</p>
        <p class="text-3xl font-black dark:text-white">{{ $statsAppo['cancelados'] }}</p>
    </div>
</div>