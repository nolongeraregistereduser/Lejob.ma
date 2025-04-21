import React, { useState, useEffect } from 'react';
import axios from 'axios';
import CvForm from './CvForm';
import CvPreview from './CvPreview';
import { PDFDownloadLink } from '@react-pdf/renderer';
import CvPdfTemplate1 from './templates/CvPdfTemplate1';
import CvPdfTemplate2 from './templates/CvPdfTemplate2';

const CvBuilder = () => {
  // Sample data for initial full preview
  const initialData = {
    name: 'Jamal Benkirane',
    titre: 'Full Stack Developer',
    email: 'jamal.benkirane@example.com',
    phone: '+212 612-345678',
    education: 'ENSIAS | Master in Computer Science | 2019-2021\nUniversité Mohammed V | Bachelor in Computer Engineering | 2015-2019',
    experience: 'TechMaroc | Senior Developer | 2021-Present | Led team of 5 developers on e-commerce platform\nKinani Solutions | Junior Developer | 2019-2021 | Developed and maintained client websites',
    skills: 'JavaScript, PHP, Laravel, React, MySQL, Docker, AWS, Git',
    certifications: 'AWS Certified Developer | AWS | 2022\nLaravel Certification | Laravel | 2021',
    languages: 'Arabic (Native), French (Fluent), English (Professional)',
    projects: 'E-commerce Platform | Full-stack marketplace with payment integration | React, Laravel, MySQL\nHealthcare App | Mobile app for medical appointments | React Native, Firebase',
  };
  
  const [formData, setFormData] = useState(initialData);
  const [selectedTemplate, setSelectedTemplate] = useState('template1');
  const [loading, setLoading] = useState(false);
  const [saved, setSaved] = useState(false);

  useEffect(() => {
    // Load user data if editing an existing CV
    const fetchData = async () => {
      try {
        const response = await axios.get('/api/cv/current');
        if (response.data) {
          setFormData(response.data);
        }
      } catch (error) {
        console.error('Error fetching CV data', error);
      }
    };
    fetchData();
  }, []);

  const handleFormChange = (newData) => {
    setFormData(newData);
    setSaved(false);
  };

  const handleTemplateChange = (template) => {
    setSelectedTemplate(template);
  };

  const handleSave = async () => {
    setLoading(true);
    try {
      await axios.post('/api/cv', formData);
      setSaved(true);
      setTimeout(() => setSaved(false), 3000); // Hide message after 3 seconds
    } catch (error) {
      console.error('Error saving CV', error);
    } finally {
      setLoading(false);
    }
  };

  const getSelectedPdfTemplate = () => {
    return selectedTemplate === 'template1' ? 
      <CvPdfTemplate1 formData={formData} /> : 
      <CvPdfTemplate2 formData={formData} />;
  };

  return (
    <div className="container mx-auto px-4 py-8">
      {/* Template Selection */}
      <div className="mb-8">
        <h2 className="text-2xl font-bold mb-4">Choose a Template</h2>
        <div className="flex flex-wrap gap-6">
          <div 
            className={`w-48 cursor-pointer transition-all duration-200 ${selectedTemplate === 'template1' ? 'ring-4 ring-blue-500' : 'hover:shadow-lg'}`}
            onClick={() => handleTemplateChange('template1')}
          >
            <div className="bg-blue-600 text-white p-3 text-center font-bold rounded-t-lg">
              Modern Template
            </div>
            <div className="bg-white border-2 border-t-0 border-gray-300 p-3 h-32 rounded-b-lg">
              <div className="bg-blue-100 h-4 w-full mb-2 rounded"></div>
              <div className="bg-gray-100 h-2 w-full mb-1 rounded"></div>
              <div className="bg-gray-100 h-2 w-3/4 mb-3 rounded"></div>
              <div className="flex flex-wrap gap-1">
                {[1, 2, 3, 4].map(i => (
                  <div key={i} className="bg-blue-50 h-3 w-8 rounded"></div>
                ))}
              </div>
            </div>
          </div>
          
          <div 
            className={`w-48 cursor-pointer transition-all duration-200 ${selectedTemplate === 'template2' ? 'ring-4 ring-blue-500' : 'hover:shadow-lg'}`}
            onClick={() => handleTemplateChange('template2')}
          >
            <div className="bg-gray-800 text-white p-3 text-center font-bold rounded-t-lg">
              Classic Template
            </div>
            <div className="bg-white border-2 border-t-0 border-gray-300 p-3 h-32 rounded-b-lg flex">
              <div className="bg-gray-800 w-1/3 h-full mr-2 rounded"></div>
              <div className="flex-1">
                <div className="bg-gray-200 h-3 w-full mb-2 rounded"></div>
                <div className="bg-gray-200 h-3 w-1/2 mb-3 rounded"></div>
                <div className="bg-gray-100 h-2 w-full mb-1 rounded"></div>
                <div className="bg-gray-100 h-2 w-full mb-1 rounded"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Strict Side-by-Side Layout with fixed widths */}
      <div style={{ display: 'flex', flexDirection: 'row', gap: '2rem' }}>
        {/* Form Section - Fixed 40% width */}
        <div style={{ width: '40%', flexShrink: 0 }}>
          <div className="bg-white p-6 rounded-lg shadow-lg">
            <CvForm 
              formData={formData}
              onFormChange={handleFormChange}
            />
            
            <div className="mt-8 flex flex-wrap gap-4">
              <button 
                onClick={handleSave}
                disabled={loading}
                className="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition duration-200 disabled:opacity-50"
              >
                {loading ? 'Saving...' : 'Save CV'}
              </button>
              
              <PDFDownloadLink 
                document={getSelectedPdfTemplate()} 
                fileName={`${formData.name.replace(/\s+/g, '_')}_CV.pdf`}
                className="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition duration-200"
              >
                {({ loading: pdfLoading }) => pdfLoading ? 'Generating PDF...' : 'Download PDF'}
              </PDFDownloadLink>
            </div>
            
            {saved && (
              <div className="mt-4 p-3 bg-green-100 text-green-700 rounded-md">
                CV saved successfully!
              </div>
            )}
          </div>
        </div>
        
        {/* Preview Section - Fixed 60% width */}
        <div style={{ width: '60%', flexShrink: 0 }}>
          <div className="bg-white p-6 rounded-lg shadow-lg">
            <h2 className="text-2xl font-bold mb-4">Live Preview</h2>
            <div className="bg-gray-50 p-4 border border-gray-200 rounded-lg">
              <CvPreview 
                template={selectedTemplate} 
                formData={formData}
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CvBuilder;