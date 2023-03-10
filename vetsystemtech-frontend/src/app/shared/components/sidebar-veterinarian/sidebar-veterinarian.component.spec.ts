import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SidebarVeterinarianComponent } from './sidebar-veterinarian.component';

describe('SidebarVeterinarianComponent', () => {
  let component: SidebarVeterinarianComponent;
  let fixture: ComponentFixture<SidebarVeterinarianComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SidebarVeterinarianComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SidebarVeterinarianComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
