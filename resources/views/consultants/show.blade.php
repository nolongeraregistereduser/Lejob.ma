@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(request()->has('cancelled'))
        <div class="alert alert-danger">
            Paiement annulé. Veuillez réessayer.
        </div>
    @endif

    <div class="row">
        <!-- Consultant profile card -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <!-- Profile image -->
                    @if($consultant->profile_picture)
                        <img src="{{ asset('storage/' . $consultant->profile_picture) }}" 
                             alt="{{ $consultant->name }}" 
                             class="rounded-circle img-fluid mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                             style="width: 150px; height: 150px;">
                            <span class="h1">{{ substr($consultant->name, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <h3>{{ $consultant->name }}</h3>
                    @if($consultant->speciality)
                        <p class="text-muted">{{ $consultant->speciality }}</p>
                    @endif
                    
                    <div class="mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                        <span class="ms-2">({{ $feedbacks->count() }} avis)</span>
                    </div>
                    
                    <h5>{{ $consultant->hourly_rate ?? 300 }} MAD / heure</h5>
                    
                    @if($consultant->bio)
                        <p class="text-muted">{{ $consultant->bio }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Booking form and reviews -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Réserver un rendez-vous</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('stripe.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
                        
                        <div class="mb-3">
                            <label for="date" class="form-label">Date du rendez-vous</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                id="date" name="date" min="{{ date('Y-m-d') }}" required>
                            @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="time_slot" class="form-label">Créneau horaire</label>
                            <select class="form-select @error('time_slot') is-invalid @enderror" 
                                id="time_slot" name="time_slot" required>
                                <option value="">Sélectionnez un créneau</option>
                                <option value="09:00:00">09:00</option>
                                <option value="10:00:00">10:00</option>
                                <option value="11:00:00">11:00</option>
                                <option value="14:00:00">14:00</option>
                                <option value="15:00:00">15:00</option>
                                <option value="16:00:00">16:00</option>
                            </select>
                            @error('time_slot')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes ou questions</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                id="notes" name="notes" rows="3"></textarea>
                            @error('notes')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Réservez un rendez-vous ({{ $consultant->hourly_rate ?? 300 }} MAD)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Feedbacks section -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Avis des clients</h4>
                    <span class="badge bg-primary">{{ $feedbacks->count() }}</span>
                </div>
                <div class="card-body">
                    @if($feedbacks->count() > 0)
                        @foreach($feedbacks as $feedback)
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>{{ $feedback->user->name }}</strong>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p>{{ $feedback->comment }}</p>
                                <small class="text-muted">{{ $feedback->created_at->format('d/m/Y') }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Aucun avis pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection