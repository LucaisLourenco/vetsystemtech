import { TestBed } from '@angular/core/testing';

import { TutorsResolverGuard } from './tutors.resolver.guard';

describe('TutorsResolverGuard', () => {
  let guard: TutorsResolverGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(TutorsResolverGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
