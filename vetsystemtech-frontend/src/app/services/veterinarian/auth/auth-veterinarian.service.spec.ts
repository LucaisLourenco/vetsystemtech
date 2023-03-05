import { TestBed } from '@angular/core/testing';

import { AuthVeterinarianService } from './auth-veterinarian.service';

describe('AuthVeterinarianService', () => {
  let service: AuthVeterinarianService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AuthVeterinarianService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
