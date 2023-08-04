@if (!empty($address->street_address))
  @php $street_address = $address->street_address @endphp
@endif
<address class="uk-margin-remove">
  <span>{{ ( !empty($street_address->street_number) ? $street_address->street_number : '' ) }} {{ !empty($street_address->street_name_short) ? $street_address->street_name_short : $street_address->street_name }}</span>
  @if (!empty($address->address_2))
    <span>{{ $address->address_2 }}</span>
  @endif
  @if (!empty($street_address->city) && !empty($street_address->state_short) )
    <span>{{ $street_address->city }}, {{ $street_address->state_short }} {{ $street_address->post_code }}</span>
  @endif
  @if (!empty($email))
    <span><a href="mailto:{{ $email }}">{{ $email }}</a></span>
  @endif
  @if (!empty($phone_number))
    <span><a href="tel:{{ $phone_number }}">{{ $phone_number }}</a></span>
  @endif
</address>
