import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { VeterinarianRoutingModule } from './veterinarian-routing.module';
import { VeterinarianComponent } from './veterinarian.component';

@NgModule({
  declarations: [VeterinarianComponent],
  imports: [CommonModule, VeterinarianRoutingModule],
})
export class VeterinarianModule {}
