@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->currency, 'classrow' => 'font-bold' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->code, 'classrow' => 'font-bold' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> ($item->rate!=1?number_format($item->rate,2):$item->rate).($item->rate!=1?' / '.number_format(1/$item->rate,2):' / '.$item->rate), 'classrow' => 'font-bold text-right' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->getString('1234567890.0123456789'), 'classrow' => 'font-bold text-cool-gray-500 text-right' ])
