@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <x-page-header pretitle="Voucher" title="Tambah Voucher" />
        <x-page-body>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm border-light-subtle rounded-3">
                        <div class="card-body">
                            <form action="{{ route('voucher.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Kode Voucher</label>
                                    <input type="text" name="code"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                        placeholder="Kode Vouccher" value="{{ old('code') }}">
                                    <x-error-message error="code" />
                                </div>
                                <div class="form-group">
                                    <label for="code">Tanggal Mulai</label>
                                    <input type="date" name="start_date"
                                        value="{{ $errors->has('start_date') ? old('start_date') : now()->startOfMonth()->format('Y-m-d') }}"
                                        placeholder="Kode Vouccher" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="code">Tanggal Berakhir</label>
                                    <input type="date" name="expired_date" class="form-control"
                                        value="{{ $errors->has('expired_date') ? old('expired_date') : now()->endOfMonth()->format('Y-m-d') }}"
                                        placeholder="Kode Vouccher">
                                </div>

                                <div class="form-group">
                                    <label for="amount">Nilai Diskon</label>
                                    <input type="number" name="amount"
                                        class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        placeholder="Jumlah Diskon" value="{{ old('amount') }}">
                                    <x-error-message error="amount" />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Keterangan(Optional)</label>
                                    <textarea name="description" class="form-control" placeholder="Keterangan" rows="3">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status"
                                        class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                        <option value="">Pilih Status</option>
                                        <option value="active">Aktif</option>
                                        <option value="expired">Expired</option>
                                    </select>
                                    <x-error-message error="status" />
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <button class="btn btn-teal rounded-2">
                                        Simpan
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
