@extends('layouts.app')



@section('content')
<div class="container py-4">
    @if(request()->has('cancelled'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle me-2"></i> Paiement annulé. Veuillez réessayer.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Consultant profile card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body text-center p-4">
                    <!-- Profile image -->
                    @if($consultant->profile_picture)
                        <div class="position-relative mx-auto mb-4" style="width: 140px; height: 140px;">
                            <img src="{{ asset('storage/' . $consultant->profile_picture) }}" 
                                 alt="{{ $consultant->name }}" 
                                 class="rounded-circle shadow border border-3 border-white" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute bottom-0 end-0 bg-success p-1 rounded-circle text-white">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    @else
                        <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow" 
                             style="width: 140px; height: 140px;">
                            <span class="display-4 fw-bold">{{ substr($consultant->name, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <h3 class="fw-bold mb-1">{{ $consultant->name }}</h3>
                    @if($consultant->speciality)
                        <p class="text-muted mb-3">
                            <i class="fas fa-briefcase me-2"></i>{{ $consultant->speciality }}
                        </p>
                    @endif
                    
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                        <span class="ms-2 text-muted">({{ $feedbacks->count() }} avis)</span>
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                            <i class="fas fa-tags me-1"></i>
                            {{ $consultant->hourly_rate ?? 300 }} MAD/h
                        </span>
                        <span class="badge bg-light text-dark rounded-pill px-3 py-2 fs-6">
                            <i class="fas fa-users me-1"></i>
                            {{ rand(10, 100) }} clients
                        </span>
                    </div>
                    
                    @if($consultant->bio)
                        <div class="alert alert-light mb-0 text-start">
                            <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i>À propos</h6>
                            <p class="mb-0 small">{{ $consultant->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Booking form and reviews -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-calendar-check me-2 text-primary"></i>
                        Réserver un rendez-vous
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('stripe.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold">Date du rendez-vous</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar-alt text-muted"></i>
                                    </span>
                                    <input type="date" class="form-control border-start-0 ps-0 @error('date') is-invalid @enderror" 
                                        id="date" name="date" min="{{ date('Y-m-d') }}" required>
                                </div>
                                @error('date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="time_slot" class="form-label fw-semibold">Créneau horaire</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-clock text-muted"></i>
                                    </span>
                                    <select class="form-select border-start-0 ps-0 @error('time_slot') is-invalid @enderror" 
                                        id="time_slot" name="time_slot" required>
                                        <option value="">Sélectionnez un créneau</option>
                                        <option value="09:00:00">09:00</option>
                                        <option value="10:00:00">10:00</option>
                                        <option value="11:00:00">11:00</option>
                                        <option value="14:00:00">14:00</option>
                                        <option value="15:00:00">15:00</option>
                                        <option value="16:00:00">16:00</option>
                                    </select>
                                </div>
                                @error('time_slot')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label for="notes" class="form-label fw-semibold">Notes ou questions</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-comment-alt text-muted"></i>
                                </span>
                                <textarea class="form-control border-start-0 ps-0 @error('notes') is-invalid @enderror" 
                                    id="notes" name="notes" rows="3" 
                                    placeholder="Décrivez brièvement l'objectif de votre consultation..."></textarea>
                            </div>
                            @error('notes')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="d-block fw-semibold">Prix total:</span>
                                <span class="fs-4 text-primary fw-bold">{{ $consultant->hourly_rate ?? 300 }} MAD</span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-credit-card me-2"></i>
                                Réserver maintenant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Feedbacks section -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-star me-2 text-warning"></i>
                        Avis des clients
                    </h4>
                    <span class="badge bg-primary rounded-pill px-3 py-2">{{ $feedbacks->count() }}</span>
                </div>
                <div class="card-body p-4">
                    @if($feedbacks->count() > 0)
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-light rounded-3 p-3 me-3 text-center" style="min-width: 80px;">
                                <span class="d-block display-4 fw-bold text-primary">{{ number_format($averageRating, 1) }}</span>
                                <div class="mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($averageRating))
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-muted small">{{ $feedbacks->count() }} avis</span>
                            </div>
                            <div class="flex-grow-1">
                                @php
                                    $ratings = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                                    foreach($feedbacks as $f) {
                                        $ratings[$f->rating]++;
                                    }
                                    $total = $feedbacks->count();
                                @endphp
                                
                                @foreach($ratings as $stars => $count)
                                    <div class="d-flex align-items-center mb-1">
                                        <div class="me-2" style="width:30px">{{ $stars }}</div>
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: {{ $total ? ($count/$total*100) : 0 }}%"></div>
                                        </div>
                                        <span class="text-muted small">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>

                        @foreach($feedbacks as $feedback)
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        {{ substr($feedback->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold mb-0">{{ $feedback->user->name }}</h6>
                                        <small class="text-muted">{{ $feedback->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="mb-0">{{ $feedback->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="mb-0">Aucun avis pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection