<div class="flex flex-row space-x-2 mt-2">
    {{-- @dump($productOrder) --}}
    <div class="flex items-center">
        <p class="text-sm">Quantidade</p>
    </div>

    <x-input class="w-[80px] input-sm" type="number" wire:model.live="quantity" min=1/>
</div>
