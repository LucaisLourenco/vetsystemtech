import { TestBed } from '@angular/core/testing';

import { AuthTutorService } from './auth-tutor.service';

describe('AuthTutorService', () => {
  let service: AuthTutorService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AuthTutorService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
