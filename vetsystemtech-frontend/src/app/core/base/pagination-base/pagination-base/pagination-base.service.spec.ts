import { TestBed } from '@angular/core/testing';

import { PaginationBaseService } from './pagination-base.service';

describe('PaginationBaseService', () => {
  let service: PaginationBaseService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PaginationBaseService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
