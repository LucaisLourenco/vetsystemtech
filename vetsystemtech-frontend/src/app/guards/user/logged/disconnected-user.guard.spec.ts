import { TestBed } from '@angular/core/testing';

import { DisconnectedUserGuard } from './disconnected-user.guard';

describe('DisconnectedUserGuard', () => {
  let guard: DisconnectedUserGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(DisconnectedUserGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
