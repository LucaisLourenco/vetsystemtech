import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SidebarTutorComponent } from './sidebar-tutor.component';

describe('SidebarTutorComponent', () => {
  let component: SidebarTutorComponent;
  let fixture: ComponentFixture<SidebarTutorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SidebarTutorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SidebarTutorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
