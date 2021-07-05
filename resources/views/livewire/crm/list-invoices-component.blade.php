<div class='w-full'>
    <div class='w-full'>
        @forelse($invoices as $invoice)

        <div class='flex flex-wrap items-center justify-end w-full lg:justify-between  bg-white hover:bg-cool-gray-200 p-2 rounded-md mb-1 text-sm'>
            <div class='flex flex-wrap items-center justify-start w-full lg:w-1/2 cursor-pointer'>
                <div class='w-full sm:w-24 font-bold text-cool-gray-600 px-1'>
                    <a href='{{  route('invoices.show', ['id' => $invoice->id ]) }}' target='_blank'>{!!  $invoice->status() !!}</a>
                </div>
                <div class='flex items-center justify-start'>
                    <div class='w-24 font-bold text-cool-gray-600 px-1'>
                        <a href='{{  route('invoices.show', ['id' => $invoice->id ]) }}' target='_blank'>{{  $invoice->ref }}</a>
                    </div>
                    <div class='w-24 font-bold text-cool-gray-600 px-1'>
                        <a href='{{  route('invoices.show', ['id' => $invoice->id ]) }}' target='_blank'>{{  getDateString($invoice->invoice_date) }}</a>
                    </div>
                </div>
                <div class='font-bold text-cool-gray-600 px-1'>
                    <a href='{{  route('invoices.show', ['id' => $invoice->id ]) }}' target='_blank'>{!!  $invoice->description !!}</a>
                </div>

            </div>

            <div class='flex flex-wrap items-center justify-end lg:w-1/2 '>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-cool-gray-500'>{!!  $invoice->total_string !!}</span>
                    <span class='font-bold text-blue-400'>
                        <i class='fa fa-dollar-sign'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-green-400'>
                        <span class='font-bold text-cool-gray-500'>{!!  $invoice->paid_string !!}</span>
                        <i class='fa fa-hand-holding-usd'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-red-400'>
                        <span class='font-bold text-cool-gray-500'>{!!  $invoice->pending_string !!}</span>
                        <i class='fa fa-money-check-alt'></i>
                    </span>
                </div>
            </div>
        </div>
        @empty
            <div>
                <span class='font-bold text-red-400 px-2'>NO EXISTEN FACTURAS</span>
            </div>
        @endforelse
        @if(count($invoices)>0)
            <div class='w-full flex flex-wrap items-center justify-end text-sm p-2 bg-cool-gray-200 rounded-md'>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_total_string !!}</span>
                    <span class='font-bold text-blue-400'>
                        <i class='fa fa-dollar-sign'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-green-400'>
                        <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_paid_string !!}</span>
                        <i class='fa fa-hand-holding-usd'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-red-400'>
                        <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_pending_string !!}</span>
                        <i class='fa fa-money-check-alt'></i>
                    </span>
                </div>
            </div>
        @endif
    </div>
</div>
