@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <x-page-header pretitle="Voucher" title="Tambah Voucher" />
        <x-page-body>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm border-light-subtle rounded-3">
                        <div class="card-body">
                            <form action="{{ route('voucher.update', $voucher) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="code">Kode Voucher</label>
                                    <input type="text" name="code"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                        placeholder="Kode Vouccher" value="{{ old('code') ?: $voucher->code }}">
                                    <x-error-message error="code" />
                                </div>
                                <div class="form-group">
                                    <label for="code">Tanggal Mulai</label>
                                    <input type="date" name="start_date"
                                        value="{{ old('start_date') ?: \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}"
                                        placeholder="Kode Vouccher" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="code">Tanggal Berakhir</label>
                                    <input type="date" name="expired_date" class="form-control"
                                        value="{{ old('expired_date') ?: \Carbon\Carbon::parse($voucher->expired_date)->format('Y-m-d') }}"
                                        placeholder="Kode Vouccher">
                                </div>

                                <div class="form-group">
                                    <label for="amount">Nilai Diskon</label>
                                    <input type="number" name="amount"
                                        class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        placeholder="Jumlah Diskon" value="{{ old('amount') ?: $voucher->amount }}">
                                    <x-error-message error="amount" />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Keterangan(Optional)</label>
                                    <textarea name="description" class="form-control" placeholder="Keterangan" rows="3">{{ old('description') ?: $voucher->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status"
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                        <option value="">Pilih Status</option>
                                        <option {{ $voucher->status === 'active' ? 'selected' : '' }} value="active">Aktif
                                        </option>
                                        <option {{ $voucher->status === 'expired' ? 'selected' : '' }} value="expired">
                                            Expired</option>
                                    </select>
                                    <x-error-message error="status" />
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <button class="btn btn-teal rounded-2">
                                        Perbarui
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-page-body>
    </div>
@endsection
